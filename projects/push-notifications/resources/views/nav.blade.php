<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<!-- Navbar content  -->
  <a class="navbar-brand" href="/">boxue</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#MainMenu" aria-controls="MainMenu" aria-expanded="false">
    <span class="navbar-toggler-icon"></span>
  </button>

  @auth
  <div class="collapse navbar-collapse" id="MainMenu">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <router-link to="/devices" class="nav-link">Registered Devices</router-link>
      </li>
      <li class="nav-item">
        <router-link to="/notifications" class="nav-link">Notifications</router-link>
      </li>
    </ul>

    <ul class="navbar-nav mr-4">
    <div class="nav-item dropdown">
      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ Auth::user()->name }}
      </a>
    </div>
    </ul>
  </div>
  @endauth
</nav>