const getters = {
    getEmail: (state) => {
        return state.email;
    },
    getFiles: (state) => {
        return state.files;
    },
    getFileNames: (state) => {
        return state.fileNames;
    }
}
;

export default getters;
