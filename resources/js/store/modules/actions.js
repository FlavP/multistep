const actions = {
    setEmail(context, emailObject) {
        context.commit('setEmail', emailObject);
    },
    setFiles(context, fileObjects) {
        context.commit('setFiles', fileObjects);
    }
};

export default actions;
