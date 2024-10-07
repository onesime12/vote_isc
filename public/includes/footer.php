</main>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="loginForm" method="POST" action="./login">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div id="loginError" class="text-danger"></div>
          <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="../js/script.js"></script>
<script src="../bootstrap/assets/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../bootstrap/assets/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../bootstrap/assets/dist/js/bootstrap.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
</body>

</html>