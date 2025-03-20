<template>
  <div>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#">Vue CRUD Week12</a>
        <div class="navbar-nav">
          <router-link to="/" class="nav-link">Home</router-link>
          <router-link to="/customer" class="nav-link">Customer</router-link>
          <router-link to="/department" class="nav-link">Department</router-link>
        </div>
      </div>
    </nav>
    <router-view />
  </div>
</template>

<style>
.navbar {
  background-color: #f8f9fa !important;
}
.nav-link {
  font-size: 1.1rem;
  color: #2c3e50 !important;
  transition: color 0.3s;
}
.nav-link:hover {
  color: #42b983 !important;
}
</style>