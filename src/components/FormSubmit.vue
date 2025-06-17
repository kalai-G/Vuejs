<template>
  <form @submit.prevent="submitForm">
    <!-- Text Input -->
    <div>
      <label>Name:</label>
      <input type="text" v-model="form.name" />
      <p v-if="formErrors.name" style="color: red">{{ formErrors.name }}</p>
    </div>

    <!-- Email Input -->
    <div>
      <label>Email:</label>
      <input type="email" v-model="form.email" />
      <p v-if="formErrors.email" style="color: red">{{ formErrors.email }}</p>
    </div>

    <!-- Number Input -->
    <div>
      <label>Age:</label>
      <input type="number" v-model="form.age" min="1" />
      <p v-if="formErrors.age" style="color: red">{{ formErrors.age }}</p>
    </div>

    <!-- Radio Buttons -->
    <div>
      <label>Gender:</label>
      <label
        ><input type="radio" value="Male" v-model="form.gender" /> Male</label
      >
      <label
        ><input type="radio" value="Female" v-model="form.gender" />
        Female</label
      >
      <p v-if="formErrors.gender" style="color: red">{{ formErrors.gender }}</p>
    </div>

    <!-- Checkbox -->
    <div>
      <label
        ><input type="checkbox" v-model="form.agree" /> I agree to the
        terms</label
      >
      <p v-if="formErrors.agree" style="color: red">{{ formErrors.agree }}</p>
    </div>

    <!-- Select Dropdown -->
    <div>
      <label>Country:</label>
      <select v-model="form.country">
        <option value="">Select</option>
        <option>India</option>
        <option>USA</option>
        <option>UK</option>
      </select>
    </div>
    <p v-if="formErrors.country" style="color: red">{{ formErrors.country }}</p>

    <!-- Textarea -->
    <div>
      <label>Message:</label>
      <textarea v-model="form.message"></textarea>
    </div>

    <!-- File Upload -->
    <div>
      <label>Upload File:</label>
      <input type="file" @change="handleFileUpload" />
    </div>

    <button type="submit">Submit</button>
  </form>

  <!-- Show form data -->
  <div v-if="submitted">
    <h3>Form Submitted!</h3>
    <pre>{{ form }}</pre>
    <p>Selected File: {{ form.file?.name || "No file uploaded" }}</p>
  </div>
</template>

<script setup>
import { ref } from "vue";
const formErrors = ref({
  name: "",
  email: "",
  age: "",
  gender: "",
  agree: "",
  country: "",
});

const form = ref({
  name: "",
  email: "",
  age: null,
  gender: "",
  agree: false,
  country: "",
  message: "",
  file: null,
});

const submitted = ref(false);

function handleFileUpload(event) {
  form.value.file = event.target.files[0];
}

function submitForm() {
  // Reset errors
  Object.keys(formErrors.value).forEach((key) => {
    formErrors.value[key] = "";
  });

  let isValid = true;

  if (!form.value.name) {
    formErrors.value.name = "Name is required.";
    isValid = false;
  }

  if (!form.value.email) {
    formErrors.value.email = "Email is required.";
    isValid = false;
  }

  if (!form.value.age || form.value.age < 1) {
    formErrors.value.age = "Age must be at least 1.";
    isValid = false;
  }

  if (!form.value.gender) {
    formErrors.value.gender = "Gender is required.";
    isValid = false;
  }

  if (!form.value.country) {
    formErrors.value.country = "Please select a country.";
    isValid = false;
  }

  if (!form.value.agree) {
    formErrors.value.agree = "You must agree to the terms.";
    isValid = false;
  }

  if (!isValid) return;

  const formData = new FormData();
  formData.append("name", form.value.name);
  formData.append("email", form.value.email);
  formData.append("age", form.value.age);
  formData.append("gender", form.value.gender);
  formData.append("agree", form.value.agree ? "1" : "0");
  formData.append("country", form.value.country);
  formData.append("message", form.value.message);
  if (form.value.file) {
    formData.append("file", form.value.file);
  }

  fetch("http://localhost:8000/save.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.text())
    .then((response) => {
      alert(response);
      submitted.value = true;
    })
    .catch((err) => {
      console.error("Error:", err);
    });
}
</script>

<style scoped>
form > div {
  margin-bottom: 1rem;
}
form {
  max-width: 500px;
  margin: 20px auto;
  padding: 1.5rem;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form > div {
  margin-bottom: 1rem;
}

label {
  display: block;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: #333;
}

input[type="text"],
input[type="email"],
input[type="number"],
select,
textarea {
  width: 100%;
  padding: 0.6rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
  box-sizing: border-box;
}

input[type="radio"],
input[type="checkbox"] {
  margin-right: 5px;
}

textarea {
  resize: vertical;
}

button[type="submit"] {
  padding: 0.6rem 1.2rem;
  background-color: #007bff;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #0056b3;
}

pre {
  background-color: #eee;
  padding: 1rem;
  border-radius: 4px;
  overflow-x: auto;
}

h3 {
  text-align: center;
  color: green;
}
</style>
