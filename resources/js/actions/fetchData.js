export function fetchData() {
    return axios
        .get("")
        .then(res => {
            if (res.status === 200 && res.statusText === "OK" && res.data.status === true) {
                return res.data;
            }
            console.warn("Oopst there are some errors! Please check `fetchData` function in file fetchData.js!")
            return res;
        })
        .catch(err => {
            console.warn("Oopst there are some errors! Please check `fetchData` function in file fetchData.js!")
            console.error(err);
        })
}

export function fetchDeleteData(delete_id) {
    return axios
        .delete(`${window.location.href}/${delete_id}`)
        .then(res => {
            if (res.status === 200 && res.statusText === "OK" && res.data.status === true) {
                return res.data;
            }
            console.warn("Oopst there are some errors! Please check `fetchData` function in file fetchData.js!")
            return res;
        })
        .catch(err => {
            console.warn("Oopst there are some errors! Please check `fetchData` function in file fetchData.js!")
            console.error(err);
        })
}
