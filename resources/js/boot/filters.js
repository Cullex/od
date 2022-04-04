// Filters or pipes
import Vue from "vue";

Vue.filter('string_limit', function (value , limit = 20   , preceding = '...' ) {
    return value.length > limit ? value.substr( 0 ,  limit ) + preceding : value;
});
