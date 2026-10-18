<!doctype html>
<html lang="hu">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Művészfilm Kht. – Mozik</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/minty/bootstrap.min.css">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
  @include('header')

  <main class="container flex-grow-1 py-4">
    {{ $slot }}
  </main>

  <footer class="bg-dark text-light py-3 mt-auto">
    <div class="container text-center small">
      Készítette: Fődi Kinga (EW67RO) - Lőrik Levente (AICYHB)
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>