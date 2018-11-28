<template>
<div>
<nav class="bg-dark">
  <ul class="list-group">
    <router-link :to="{ name: 'posts' }" tag="li" class="nav-item list-group-item list-group-item-dark m-3 text-monospace" ><a class="nav-link text-dark">All Posts</a></router-link> 
    <router-link :to="{ name: 'create.post' }" tag="li" class="nav-item list-group-item list-group-item-dark m-3 text-monospace" ><a class="nav-link text-dark">Create posts</a></router-link> 
  </ul>
</nav>

</div>
</template>
