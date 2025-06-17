<!-- App.vue -->
<template>
  <FormSubmit />
</template>

<script>
import FormSubmit from "./components/FormSubmit.vue";

export default {
  name: "App",
  components: {
    FormSubmit,
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
