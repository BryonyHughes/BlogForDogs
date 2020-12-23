@extends('layouts.app')

@section('title', 'Create a Post')

@section('content')


<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<h1>Comments</h1>
 <div id ="root">
   <ul>
     <li v-for="comment in comments">@{{ comment.body }}</li>
   </ul>

   <h2>New Comment</h2>
    Comment: <input type="text" id="input" v-model="newComment">
    <button @click="createComment">Post Comment</button>
 </div>

<script>
 var app = new Vue({
   el: "#root",
   data:{
      comments: [],
      newComment: '',
     },
   mounted() {
   axios.get("{{ route('api.comments.index') }}")
   .then(response => {
     this.comments = response.data;
   })
   .catch(response => {
     console.log(response);
   })
 },
 methods: {
   createComment: function () {
     axios.post("{{route ('api.comments.store')}}",{
       body: this.newComment
     })
     .then(response=>{
       this.comments.push(response.data);
       this.newComment = '';
     })
     .catch(response =>{
       console.log(response);
     })

   }
 }

});
</script>

















@endsection
