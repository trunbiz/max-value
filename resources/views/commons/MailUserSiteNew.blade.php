<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Publisher.maxvalue.media Publihser a has just been added a new website</title>
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
            <h2 class="card-title">Publisher.maxvalue.media Publihser a has just been added a new website, let's check it</h2>
            <p>Hello {{$userAdmin}}</p>

            <p>Publihser a has just been added a new website, let's check it:</p>

            <ul class="list-group">
                <li class="list-group-item"><strong>Name:</strong> {{$name}}</li>
                <li class="list-group-item"><strong>Website:</strong> {{$url}}</li>
                <li class="list-group-item"><strong>Link:</strong> <a href="https://publisher.maxvalue.media/administrator/websites">Link</a> </li>
                <li class="list-group-item"><strong>Created at:</strong> {{$created_at}}</li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
