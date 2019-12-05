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
              <router-link to="/register" class="primary-btn">Create an Account </router-link>
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
                <button
                  type="button"
                  value="submit"
                  class="primary-btn"
                  v-on:click="Login()"
                >SIGN IN</button>
                <div style="margin-top: 20px">
                  <label>Or Sign in with</label>
                </div>
              </div>
              <!-- <div class="col-md-6 form-group">
                <button type="button" value="submit" class="btn btn-primary" v-on:click="Log()">
                  <i style="padding-right:20px" class="fa fa-facebook-official" aria-hidden="true"></i>FACEBOOK
                </button>
              </div>
              <div class="col-md-6 form-group">
                <button type="button" value="submit" class="btn btn-danger">
                  <i style="padding-right:20px" class="fa fa-google" aria-hidden="true"></i>GOOGLE
                </button>
              </div> -->
            </form>
            <!-- <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div> -->
            <g-signin-button
              :params="googleSignInParams"
              @success="onSignInSuccess"
              @error="onSignInError"
            >Sign in with Google</g-signin-button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import Vue from "vue";
import GSignInButton from "vue-google-signin-button";
Vue.use(GSignInButton);
export default {
  computed: {},
  data: function() {
    return {
      email: "",
      password: "",
      is_hidden: true,
      message: "",
      googleSignInParams: {
        client_id:
          "851588212447-9o6vfep0r91fcqilbth1900igife0lnj.apps.googleusercontent.com"
      }
    };
  },

  mounted() {},

  created() {},
  methods: {
    onSignInSuccess(googleUser) {
      const profile = googleUser.getBasicProfile(); // etc etc
      console.log("ID: " + profile.getId()); // Don't send this directly to your server!
      console.log("Full Name: " + profile.getName());
      console.log("Given Name: " + profile.getGivenName());
      console.log("Family Name: " + profile.getFamilyName());
      console.log("Image URL: " + profile.getImageUrl());
      console.log("Email: " + profile.getEmail());
      this.loginGoogle(profile.getId(),profile.getEmail(),profile.getName());
    },
    onSignInError(error) {
      // `error` contains any error occurred.
      console.log("OH NOES", error);
    },
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
          var r = confirm("Log in successfully!");
          if (r == true) {
            self.$router.push("/");
          }
        })
        .catch(function(error) {
          console.log(error);
          self.is_hidden = false;
          self.message = "Invalid email or password";
        });
    },

    closeAlert() {
      this.is_hidden = true;
    },

    loginGoogle(id,email,name) {
      var self = this;
      axios
        .post("api/v1/googleLogin", {
          id: id,
          email: email,
          name: name,
        })
        .then(function(response) {
          console.log(response);
          self.$store.commit("updateToken", response.data.token);
          var r = confirm("Login successfully!");
          if (r == true) {
            self.$router.push("/");
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
<style>
.g-signin-button {
  /* This is where you control how the button looks. Be creative! */
  display: inline-block;
  padding: 4px 8px;
  border-radius: 3px;
  background-color: #3c82f7;
  color: #fff;
  box-shadow: 0 3px 0 #0f69ff;
}
</style>