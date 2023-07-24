<div class="p-2">
    <h1 class="p-2">Contact Us</h1>

    <form action="/contact" method="POST">
        <div class="mb-3">
          <label for="subject" class="form-label">subject</label>
          <input type="text" class="form-control" id="subject">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
          <label for="body" class="form-label">Body</label>
          <textarea class="form-control" id="body" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
