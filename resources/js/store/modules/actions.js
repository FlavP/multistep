const actions = {
    setEmail(context, emailObject) {
        console.log(emailObject);
        context.commit('setEmail', emailObject);
    }
};

export default actions;
