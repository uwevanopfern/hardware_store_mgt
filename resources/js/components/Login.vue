<template>
  <div class="nk-body npc-crypto ui-clean pg-auth">
    <!-- app body @s -->
    <div class="nk-app-root">
      <div class="nk-split nk-split-page nk-split-md">
        <div
          class="nk-split-content nk-block-area nk-block-area-column nk-auth-container"
        >
          <div class="absolute-top-right d-lg-none p-3 p-sm-5">
            <a
              href="#"
              class="toggle btn-white btn btn-icon btn-light"
              data-target="athPromo"
            >
              <em class="icon ni ni-info"></em>
            </a>
          </div>
          <div class="nk-block nk-block-middle nk-auth-body">
            <div class="brand-logo pb-5">
              <h3 class="nk-block-title">Hardware Store</h3>
            </div>
            <div class="nk-block-head">
              <div class="nk-block-head-content">
                <h5 class="nk-block-title">Sign-In</h5>
                <div class="nk-block-des">
                  <p>
                    Access the dashboard panel using your email and password.
                  </p>
                </div>
              </div>
            </div>
            <!-- .nk-block-head -->
            <form @submit.prevent="login()">
              <div class="form-group">
                <div class="form-label-group">
                  <label class="form-label" for="default-01"
                    >Email or Username</label
                  >
                  <a class="link link-primary link-sm" tabindex="-1" href="#"
                    >Need Help?</a
                  >
                </div>
                <input
                  type="text"
                  class="form-control form-control-lg"
                  id="default-01"
                  placeholder="Enter your email address"
                  v-model="form.email"
                />
              </div>
              <!-- .foem-group -->
              <div class="form-group">
                <div class="form-label-group">
                  <label class="form-label" for="password">Password</label>
                  <a class="link link-primary link-sm" tabindex="-1" href="#"
                    >Forgot Password?</a
                  >
                </div>
                <div class="form-control-wrap">
                  <a
                    tabindex="-1"
                    href="#"
                    class="form-icon form-icon-right passcode-switch"
                    data-target="password"
                  >
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                  </a>
                  <input
                    type="password"
                    class="form-control form-control-lg"
                    id="password"
                    placeholder="Enter your password"
                    v-model="form.password"
                  />
                </div>
              </div>
              <!-- .foem-group -->
              <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                  Sign in
                </button>
              </div>
            </form>
            <!-- form -->
          </div>
          <!-- .nk-block -->
          <div class="nk-block nk-auth-footer">
            <div class="mt-3">
              <p>&copy; 2020 Hardware Store. All Rights Reserved.</p>
            </div>
          </div>
          <!-- .nk-block -->
        </div>
      </div>
      <!-- .nk-split -->
    </div>
    <!-- app body @e -->
    <!-- JavaScript -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    /**
     * Admin login
     * @param email
     * @param password
     */
    login() {
      this.$store
        .dispatch("login", this.form)
        .then((res) => this.$router.push("/dashboard"))
        .catch((err) => console.log(err));
    },
  },
};
</script>