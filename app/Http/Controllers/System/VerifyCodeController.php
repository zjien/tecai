<?php

namespace tecai\Http\Controllers\System;

use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;

use Namshi\JOSE\Signer\SignerInterface;
use tecai\Http\Requests;
use tecai\Http\Controllers\Controller;
use tecai\Repositories\Interfaces\System\PermissionRepository;
use tecai\Transformers\CommonTransformer;

class VerifyCodeController extends Controller
{
    /**
     * @var PermissionRepository
     */
    protected $repository;

    /**
     * @param PermissionRepository $permissionRepository
     *
     */
    public function __construct(PermissionRepository $permissionRepository) {//注入仓库接口
        $this->repository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //根据id查询，角色名查询，描述查询
        return $this->response()->paginator($this->repository->paginate(),new CommonTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = $this->repository->create($request->all());
        return $this->response()->created(generateResourceURI() . '/' .$model->id);
    }

    public function show(Request $request)
    {
        $captcha = new CaptchaBuilder();
        $data = $captcha->build()->get();
        $mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $data);
        $length = strlen($data);

//        $phrase = $this->getSigner()->sign($captcha->getPhrase(), config('jwt.secret'));
        $phrase = $captcha->getPhrase();

        $payload = base64_encode(json_encode(
            [
                'ip' => $request->getClientIp(),
                'expire' => $_SERVER['REQUEST_TIME'] + 180
            ]
        ));
        $encrypt = hash_hmac('sha256', $payload . $phrase, config('jwt.secret'));
        $response = \Response::make($data, 200, ['Phrase' => $payload . '.' . $encrypt]);
        $response->header('Content-Type', $mime);
        $response->header('Content-Length', $length);
        return $response;
    }

    /**
     * @return SignerInterface
     * @throws \InvalidArgumentException
     */
    protected function getSigner()
    {
        $signerClass = sprintf('Namshi\\JOSE\\Signer\\OpenSSL\\%s', config('jwt.algo'));

        if (class_exists($signerClass)) {
            return new $signerClass();
        }

        throw new \InvalidArgumentException(
            sprintf("The algorithm '%s' is not supported for %s", $this->header['alg'], $this->encryptionEngine));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($request->all(), $id);
        return $this->response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return $this->response()->noContent();
    }
}
