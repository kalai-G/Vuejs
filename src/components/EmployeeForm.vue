<template>
  <div class="container" id="employee-form">
    <form @submit.prevent="handler">
      <div class="form-group">
        <label for="name">Employee Name :</label>
        <input
          type="text"
          class="form-control"
          name="name"
          v-model="form.name"
        />
        <div class="text-danger" v-if="submitted && invalidName">
          Name is required.
        </div>
      </div>

      <div class="form-group">
        <label for="email">Employee Email :</label>
        <input
          type="email"
          class="form-control"
          name="email"
          v-model="form.email"
        />
        <div class="text-danger" v-if="submitted && invalidEmail">
          Valid email is required.
        </div>
      </div>

      <button type="submit" class="btn" style="float: right">Submit</button>
    </form>
  </div>
</template>
<style scoped>
.container {
  max-width: 500px;
  margin: 40px auto;
  background: #f8f9fa;
  padding: 71px;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

form {
  width: 100%;
}

.form-group {
  margin-bottom: 20px;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 8px;
  color: #343a40;
}

input.form-control {
  width: 100%;
  padding: 10px;
  border: 1px solid #ced4da;
  border-radius: 6px;
  font-size: 16px;
}

input.form-control:focus {
  border-color: #4c8bf5;
  outline: none;
  box-shadow: 0 0 0 2px rgba(76, 139, 245, 0.2);
}

.text-danger {
  color: #dc3545;
  font-size: 14px;
  margin-top: 5px;
}

.btn {
  background-color: #4c8bf5;
  color: white;
  padding: 10px 16px;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  cursor: pointer;
}

.btn:hover {
  background-color: #376fd0;
}
</style>

<script>
export default {
  name: "employee-form",
  data() {
    return {
      form: {
        name: "",
        email: "",
      },
      submitted: false,
    };
  },
  computed: {
    invalidName() {
      return this.form.name.trim() === "";
    },
    invalidEmail() {
      const email = this.form.email.trim();
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return email === "" || !regex.test(email);
    },
  },
  methods: {
    handler() {
      this.submitted = true;
      if (!this.invalidName && !this.invalidEmail) {
        this.$emit("add:form", { ...this.form });
        this.form.name = "";
        this.form.email = "";
        this.submitted = false;
      }
    },
  },
};
</script>
