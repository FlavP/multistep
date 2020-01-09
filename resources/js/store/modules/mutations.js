const mutations = {
    setEmail(state, emailObject) {
        state.email = emailObject.email;
    },
    setFiles(state, fileObjects) {
        state.files = fileObjects.files;
        state.fileNames = fileObjects.fileNames;
    }
};

export default mutations;
