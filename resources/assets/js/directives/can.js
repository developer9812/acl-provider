import Permission from '../services/Permission'

export default {
  bind: function (el, binding, vnode) {
    if (!Permission.hasPermission(binding.arg)) {
      	const comment = document.createComment(' ');
      	vnode.elm = comment;
      	vnode.isComment = true;
        return;
    }
  }
}
