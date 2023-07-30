
<div class="p-2">
    <h1 class="p-2">Login</h1>

    <form action="/login" method="POST">
        <div class="mb-3">
          <label for="firstname" class="form-label">Firstname</label>
          <input type="text" class="form-control" name="firstname" id="firstname">
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label">Lastname</label>
          <input type="text" class="form-control" name="lastname" id="lastname>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input class="form-control" type="password" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
