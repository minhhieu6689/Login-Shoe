<template>
  <section class="login_box_area section_gap">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="register_form_inner">
          <h3 style="margin-bottom:30px; text-align:center">Register</h3>
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
          <form
            class="row login_form"
            action="contact_process.php"
            method="post"
            id="contactForm"
            novalidate="novalidate"
          >
            <div class="col-md-12 form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input
                type="email"
                class="form-control"
                v-model.trim="$v.email.$model"
                id="name"
                name="name"
                placeholder="Email"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Email'"
                :class="status($v.email)"
              />
              <div class="err" v-if="!$v.email.email">This is not a valid email</div>
              <div class="err" v-if="!$v.email.required">Field is required</div>
            </div>
            <div class="col-md-12 form-group">
              <label for="exampleInputEmail1">Password</label>
              <input
                type="password"
                class="form-control"
                 v-model.trim="$v.password.$model"
                id="name"
                name="name"
                placeholder="Password"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Password'"
                :class="status($v.password)"
              />
              <div class="err"  v-if="!$v.password.required">Field is required</div>
            </div>
            <div class="col-md-12 form-group">
              <label for="exampleInputEmail1">Full Name</label>
              <input
                type="text"
                class="form-control"
                v-model.trim="$v.name.$model"
                id="name"
                placeholder="Name"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Name'"
                :class="status($v.name)"
              />
              <div class="err" v-if="!$v.name.required">Field is required</div>
              <div
                class="err"
                v-if="!$v.name.minLength"
              >Name must have at least {{$v.name.$params.minLength.min}} letters.</div>
            </div>
            <div class="col-md-12 form-group">
              <label for="exampleInputEmail1">Phone</label>
              <input
                type="text"
                class="form-control"
                v-model.trim="$v.phone.$model"
                id="name"
                placeholder="Phone"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Phone'"
                :class="status($v.phone)"
              />
              <div class="err" v-if="!$v.phone.required">Field is required</div>
            </div>
            <div class="col-md-12 form-group">
              <label for="exampleInputEmail1">Address</label>
              <input
                type="text"
                class="form-control"
                v-model.trim="$v.address.$model"
                id="name"
                placeholder="Address"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Address'"
                :class="status($v.address)"
              />
              <div class="err" v-if="!$v.address.required">Field is required</div>
            </div>
            <div class="col-md-12 form-group">
              <label for="exampleInputEmail1">Birthday</label>
              <input
                type="date"
                class="form-control"
                 v-model.trim="$v.birthday.$model"
                id="name"
                placeholder="Birthday"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Birthday'"
                :class="status($v.birthday)"
              />
              <div class="err" v-if="!$v.birthday.required">Field is required</div>
            </div>

            <div class="col-md-12 form-group">
              <button
                type="button"
                value="submit"
                class="primary-btn"
                v-on:click="Register()"
              >Register</button>
            </div>
             
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import Vue from "vue";
import Vuelidate from "vuelidate";
import { email, required, minLength, between } from "vuelidate/lib/validators";
Vue.use(Vuelidate);

export default {
  data: function() {
    return {
      email: "",
      password: "",
      name: "",
      phone: "",
      address: "" , 
      birthday: "",
      is_hidden: true,
      message: "",
      submitStatus: null
    };
  },
  validations: {
    name: {
      required,
      minLength: minLength(4)
    },
    email: {
      required,
      email
    },

    password: {
      required
    },

    phone: {
      required
    },

    address: {
      required
    },

    birthday: {
      required
    }
  },

  computed: {},

  mounted() {},

  created() {},
  methods: {
    Register() {
      if (!this.$v.$invalid) {
        var self = this;
        axios
        .post("api/v1/register", {
          email: self.email,
          password: self.password,
          name: self.name,
          phone: self.phone,
          address: self.address,
          birthday: self.birthday
        })
        .then(function(response) {
          self.$store.commit("updateToken", response.data.token);
          var r = confirm("Register successfully!");
          if (r == true) {
            self.$router.push("/");
          }
        })
        .catch(function(error) {
          console.log(error);
        });
      }
      else{
        this.message = "Please fill the form correctly";
        this.is_hidden = false;
      }
      
      
    },
    status(validation) {
    	return {
      	error: validation.$error,
        dirty: validation.$dirty
      }
    },
    closeAlert() {
      this.is_hidden = true;
    }
  }
};
</script>
<style scoped>
.dirty {
  border-color: #5A5;
  background: #EFE;
}

.dirty:focus {
  outline-color: #8E8;
}

.error {
  border-color: red;
  background: #FDD;
}

.error:focus {
  outline-color: #F99;
}

.err{
  color:red;
}

</style>