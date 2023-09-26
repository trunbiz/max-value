<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Publisher.maxvalue.media You have been assigned to a website</title>
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
            <h2 class="card-title">Publisher.maxvalue.media You have been assigned to a website</h2>
            <p>Hello {{$username}},</p>

            <p>You have just been assigned by {{$admin}} to take care of a publisher {{$publisherInfo->name}}. Here are the details:</p>

            <ul class="list-group">
                <li class="list-group-item"><strong>Name:</strong> {{$publisherInfo->name}}</li>
                <li class="list-group-item"><strong>Email:</strong> {{$publisherInfo->email}}</li>
                <li class="list-group-item"><strong>Link:</strong> <a href="https://publisher.maxvalue.media/administrator/publishers">Link</a> </li>
                <li class="list-group-item"><strong>Created at:</strong> {{$created_at}}</li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
