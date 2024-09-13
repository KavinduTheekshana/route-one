<h1>ADMIN</h1>

  <!-- Authentication -->
  <form method="POST" action="{{ route('logout') }}" x-data>
    @csrf

    <input type="submit" value="LOG OUT">
</form>