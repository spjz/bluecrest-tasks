# Tasks Listing/API Demo


## Web Front

### `/`
Paginated list of current user's tasks. Supports asynchronous creation and removal of tasks.

## API Endpoints

```
Verb          Path                            Action  Route Name
GET           /api/tasks                      index   tasks.index
POST          /api/tasks                      store   tasks.store
GET           /api/tasks/{task}               show    tasks.show
PUT|PATCH     /api/tasks/{task}               update  tasks.update
DELETE        /api/tasks/{task}               destroy tasks.destroy
```

### GET /api/tasks
RESPONSE CODE: `200`
RESPONSE BODY:
``json
[
    'data': [
        [
            'id': int,
            'title': string,
            'description': string,
            'due_date': string,
            'status': int
            'created_at': datetime,
        ]
    ]
]
``

### GET /api/tasks/<id>
Fetch single task resource by specifying its unique identifier

RESPONSE CODE: `200`
RESPONSE BODY:
``json
[
    'data': [
        'id': int,
        'title': string,
        'description': string,
        'due_date': string,
        'status': int
        'created_at': datetime,
    ]
]
``

### POST /api/tasks
Create new task resource by submitting JSON data

REQUEST BODY:
``json
{
    title: string,
    description: string,
    due_date: string,
    status: int
}
``

RESPONSE CODE: `200`
RESPONSE BODY:
``json
[
    'data': [
        [
            'id': int,
            'title': string,
            'description': string,
            'due_date': string,
            'status': int
            'created_at': datetime,
        ]
    ]
]
``

### DELETE /api/tasks/<id>
Remove task object by specifying its unique identifier

RESPONSE CODE: `204`