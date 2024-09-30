<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in</title>

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/logins/login-12/assets/css/login-12.css">
</head>
<body>
    <section class="py-3 py-md-5 py-xl-8">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="mb-5">
              <h2 class="display-5 fw-bold text-center">Sign in</h2>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10 col-xl-8">
            <div class="row gy-5 justify-content-center">
              <div class="col-12 col-lg-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                  <div class="row gy-3 overflow-hidden">
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control border-0 border-bottom rounded-0 @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email')}}">
                        
                        <label for="email" class="form-label">Email</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control border-0 border-bottom rounded-0 @error('password') is-invalid @enderror"  name="password" id="password" value="" placeholder="Password" required>
                        <label for="password" class="form-label">Password</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="d-grid">
                        <button class="btn btn-lg btn-dark rounded-0 fs-6" type="submit">Log in</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
</body>
</html>
