<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Publisher.maxvalue.media {{$title}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="card mt-3">
        <div class="card-header">
            <img style="max-width: 100px"
                 src="https://publisher.maxvalue.media/assets/single/1/1/original/tvGfOmbDbyXjU2VqXoIo.png"
                 alt="Logo công ty">
        </div>
        <div class="card-body">
            <h2 class="card-title">Publisher.maxvalue.media {{$title}}</h2>
            <p>Hello {{$nameUser}}</p>
            <b>User {{$email}} change profile withdraw with data: </b>
            <ul class="list-group">
                @foreach($dataChange as $key => $value)
                    <li class="list-group-item"><strong>{{$key}}: </strong> {{$value['old'] ?? ''}} changed {{$value['new'] ?? ''}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
</body>
</html>
