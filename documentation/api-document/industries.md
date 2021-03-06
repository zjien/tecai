## Industry Api 行业接口

> Author zjien


### 获取全部行业
`GET /industries`

_请求字段_

字段 | 含义 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | :-----------------: | ------------ | ------------------
name | 行业名字 | N | string | 如：互联网
page | 当前页码 | N | int | 默认1
sorted_by | 根据哪个字段排序 | N | string | 如:sorted_by=created_at。默认根据created_at字段排序
order_by | 顺序 | N | string | 升序：ASC；降序：DESC
注意：不允许的字段会被忽略

_响应字段_

字段 | 含义 | 数据类型 | 备注
--------------- | ---------------- | :-----------------: | ------------ | ------------------
id | 行业id | int |
name | 行业名字 | string | 如：互联网 
created_at | 创建时间 | string | 2016-09-26 23:33:31
updated_at | 最后修改时间 | string | 2016-09-26 23:33:31

**响应示例：Response**
```json
{
  "data": [
    {
      "id": 30,
      "name": "烟草",
      "created_at": "2016-10-10 23:07:37",
      "updated_at": "2016-10-10 23:07:37"
    },
    {
      "id": 29,
      "name": "饮料",
      "created_at": "2016-10-10 23:07:29",
      "updated_at": "2016-10-10 23:07:29"
    },
    ...
  ],
  "meta": {
    "pagination": {
      "total": 43,
      "count": 15,
      "per_page": 15,
      "current_page": 2,
      "total_pages": 3,
      "links": {
        "previous": "http://tecai.com/industries?page=1"
        "next": "http://tecai.com/industries?page=3"
      }
    }
  }
}
```


### 获取某个行业
`GET /industries/{id}`

_请求字段_

字段 | 含义 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | :-----------------: | ------------ | ------------------
id | 行业id | Y | int | 需要写在URL上，如 `/industries/1` 获取id为1的行业
name | 行业名字 | Y | string | 如：互联网

_响应字段_

字段 | 含义 | 数据类型 | 备注
--------------- | ---------------- | :-----------------: | ------------ | ------------------
id | 行业id | int |
name | 行业名字 | string | 如：汽车工业 
created_at | 创建时间 | string | 2016-10-10 23:05:50
updated_at | 最后修改时间 | string | 2016-10-10 23:05:50

**响应示例：Response**
```json
{
  "data": {
    "id": 10,
    "name": "汽车工业",
    "created_at": "2016-10-10 23:05:50",
    "updated_at": "2016-10-10 23:05:50"
  }
}
```


### 添加行业
`POST /industries`

_请求字段_

字段 | 含义 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | :-----------------: | ------------ | ------------------
name | 行业名字 | Y | string | 如：互联网

**响应示例：Response**
创建成功返回HTTP状态码 `201`
响应体：无
响应头：
`Location: BASH_URI/industries/{id}` 如： `Location: BASH_URI/industries/1`


### 修改某个行业
`PUT/PATCH /industries/{id}`

_请求字段_

字段 | 含义 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | :-----------------: | ------------ | ------------------
id | 行业id | Y | int | 需要写在URI上
name | 行业名字 | Y | string | 如：互联网

**响应示例：Response**
成功返回HTTP状态码 `204`
响应体：无
响应头：无


### 删除某个行业
`DELETE /industries/{id}`

_请求字段_

字段 | 含义 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | :-----------------: | ------------ | ------------------
id | 行业id | Y | int | 需要写在URL上，如 `/industries/1` 删除id为1的行业

**响应示例：Response**
删除成功返回HTTP状态码 `204`
响应体：无
响应头：无