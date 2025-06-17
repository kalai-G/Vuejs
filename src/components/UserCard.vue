<template>
  <div class="card text-center border-primary">
    <img :src="avatarUrl || defaultAvatar" alt="Avatar" class="avatar" />
    <h3>{{ name }}</h3>
    <div v-html="html"></div>
    <p>{{ email }}</p>
    <button @click="cl">Toggle</button>

    <h1 v-if="awesome">Vue is awesome!
    </h1>
    <h1 v-else>Oh no 😢</h1>
    <ul v-if="isActive">
      <li v-for="item in items" :key="item">{{ item }}</li>
    </ul>

    <button @click="handleClick">Click Me</button>
    <span :class="['status', isActive ? 'active' : 'inactive']">
      {{ isActive ? "Active" : "Inactive" }}
    </span>

    <div v-if="name == 'Kalai'">A</div>
    <div v-else-if="name === 'B'">B</div>
    <div v-else-if="name === 'C'">C</div>
    <div v-else>Not A/B/C</div>

    <p v-text="message"></p>
  </div>
</template>

<script>
export default {
  name: "UserCard",
  props: {
    name: {
      type: String,
      default: "Name",
    },
    email: {
      type: String,
      default: "Not provided",
    },
    isActive: {
      type: Boolean,
      required: true,
    },
    awesome: {
      type: Boolean,
      default: false,
    },
    avatarUrl: {
      type: String,
      default: "",
    },
  },
  computed: {
    defaultAvatar() {
      return "https://via.placeholder.com/2";
    },
  },
  methods: {
    handleClick() {
      this.$emit("button-clicked", "true");
    },
    cl() {
      this.$emit("button-cl", this.awesome);
    },
  },
  data() {
    return {
      html: "<ol><li>Tomatoes</li><li>Potatoes</li></ol>",
      message: "Hello, Vue!",
      items: ["Pen", "Book", "Mouse"],
    };
  },
};
</script>

<style scoped>
.card {
  border: 1px solid #ddd;
  padding: 16px;
  width: 200px;
  text-align: center;
  border-radius: 10px;
}
.avatar {
  border-radius: 50%;
  width: 80px;
  height: 80px;
}
.status {
  padding: 4px 8px;
  border-radius: 4px;
  color: white;
  margin-top: 8px;
  display: inline-block;
}
.active {
  background-color: green;
}
.inactive {
  background-color: red;
}
</style>
