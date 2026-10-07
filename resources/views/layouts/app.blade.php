<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
@yield('title') | CreativeHub
</title>


<!-- Google Font -->

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">


<!-- Bootstrap -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<!-- Icon -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<!-- Favicon -->

<link rel="icon" href="{{asset('assets/images/logo.png')}}">



<!-- CSS -->

<link rel="stylesheet" href="{{asset('assets/css/style.css')}}?v={{time()}}">


</head>


<body>


@include('layouts.navbar')


<main>

@yield('content')

</main>


@include('layouts.footer')



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script src="{{asset('assets/js/script.js')}}"></script>


</body>

</html>