<template>
  <div class="container mt-5 text-center">
    <div class="v-logo mb-4">V</div>
    <h1 class="mb-3">65707527 Natthaphon Phothong</h1>
    <img src="/images/481917215_651374050634655_2875355805074009324_n.jpg" alt="Profile Picture" class="profile-pic mb-4" />
    <h2>VUE CRUD WEEK12</h2>
  </div>
</template>

<style>

.v-logo {
  font-size: 6rem;
  font-weight: bold;
  color: #42b983; 
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}
/* สไตล์รหัสและชื่อ */
h1 {
  font-size: 2.5rem;
  color: #2a333d;
  font-weight: 600;
}

h2 {
  font-size: 2rem;
  color: #11c775;
  font-weight: 500;
}

.profile-pic {
  width: 150px;
  height: 150px;
  border-radius: 50%; 
  object-fit: cover; 
  border: 5px solid #42b983;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
  transition: transform 0.3s ease; 
}
.profile-pic:hover {
  transform: scale(1.05);
}
</style>