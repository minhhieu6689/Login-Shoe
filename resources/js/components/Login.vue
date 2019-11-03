<template>
  <section class="login_box_area section_gap">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="login_box_img">
            <img class="img-fluid" src="frontend/img/login.jpg" alt />
            <div class="hover">
              <h4 style="color:white">New to our website?</h4>
              <p
                style="color:white"
              >There are advances being made in science and technology everyday, and a good example of this is the</p>
              <a class="primary-btn" href="registration.html">Create an Account</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="login_form_inner">
            <h3 style="margin-bottom:30px">Log in to enter</h3>

            <form
              class="row login_form"
              action="contact_process.php"
              method="post"
              id="contactForm"
              novalidate="novalidate"
            >
              <div
                class="col-md-12 alert alert-danger alert-dismissible fade show"
                v-bind:class="{hidden : is_hidden}"
                role="alert"
              >
                {{message}}
                <button
                  type="button"
                  class="close"
                  aria-label="Close"
                  v-on:click="closeAlert()"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="col-md-12 form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="email"
                  id="name"
                  name="name"
                  placeholder="Username"
                  onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Username'"
                />
              </div>
              <div class="col-md-12 form-group">
                <input
                  type="password"
                  class="form-control"
                  v-model="password"
                  id="name"
                  name="name"
                  placeholder="Password"
                  onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Password'"
                />
              </div>
              <div class="col-md-12 form-group">
                <button type="button" value="submit" class="primary-btn" v-on:click="Login()">Log In</button>
                <a href="#">Forgot Password?</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  computed: {},
  data: function() {
    return {
      email: "",
      password: "",
      is_hidden: true,
      message: ""
    };
  },

  mounted() {},

  created() {},
  methods: {
    Login() {
      var self = this;
      axios
        .post("api/v1/login", {
          email: self.email,
          password: self.password
        })
        .then(function(response) {
          console.log(response);
          self.$store.commit("updateToken", response.data.token);
          var r = confirm("Đăng nhập thành công!");
          if (r == true) {
            self.$router.push("/");
          }
        })
        .catch(function(error) {
          console.log(error);
          self.is_hidden = false;
          self.message = "Sai tên tài khoản hoặc mật khẩu";
        });
    },
    closeAlert() {
      this.is_hidden = true;
    }
  }
};
</script>