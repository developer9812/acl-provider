<template>
  <section>
    <h2> Current Counter Value is : {{ $store.state.count }} and it is {{ evenOrOdd }} </h2>
    <button class="" @click="increment(3)"> Add </button>
    <button class="" @click="add"> Add </button>
    <!-- <button class="" @click="decrement"> - <</button> -->
    <!-- <h2> Current Counter Value is : {{ countValue }} </h2> -->
  </section>
</template>
<script>
import store from '../js/store'
import { mapGetters } from 'vuex';
import { mapMutations } from 'vuex';
  export default {
    computed:{
      ...mapGetters([
        'evenOrOdd'
      ])
    },

    methods: {
      ...mapMutations([
        'increment'
      ]),
      add: function(){
        console.log('ADD');
         this.$store.dispatch('increment');
        // this.$store.commit('increment');
      }
    }

    // computed: {
    //   countValue(){
    //     console.log('COMPUTED');
    //     return this.$store.state.count;
    //   }
    // }
  }
</script>
