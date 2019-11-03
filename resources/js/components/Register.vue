<template>
  <section class="login_box_area section_gap">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="register_form_inner">
          <h3 style="margin-bottom:30px; text-align:center">Register</h3>
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
                v-model="email"
                id="name"
                name="name"
                placeholder="Email"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Email'"
              />
            </div>
            <div class="col-md-12 form-group">
              <label for="exampleInputEmail1">Password</label>
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
              <label for="exampleInputEmail1">Full Name</label>
              <input
                type="text"
                class="form-control"
                v-model="name"
                id="name"
                placeholder="Name"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Name'"
              />
            </div>
            <div class="col-md-12 form-group">
              <label for="exampleInputEmail1">Phone</label>
              <input
                type="text"
                class="form-control"
                v-model="phone"
                id="name"
                placeholder="Phone"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Phone'"
              />
            </div>
            <div class="col-md-12 form-group">
              <label for="exampleInputEmail1">Address</label>
              <input
                type="text"
                class="form-control"
                v-model="address"
                id="name"
                placeholder="Address"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Address'"
              />
            </div>
            <div class="col-md-12 form-group">
              <label for="exampleInputEmail1">Birthday</label>
              <input
                type="date"
                class="form-control"
                v-model="birthday"
                id="name"
                placeholder="Birthday"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Birthday'"
              />
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
export default {
  data: function() {
    return {
      email: "",
      password: "",
      name: "",
      phone: "",
      address: "",
      birthday: ""
    };
  },
  computed: {},

  mounted() {},

  created() {},
  methods: {
    Register() {
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
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>