import http from "@/http-common";

class PostUserDataService {

    getUser(token) {

        return http.get("/me", { headers: { Authorization: "Bearer " + localStorage.getItem("token") } });
    }

    create(data) {

        return http.post("/register", data)
    }

    login(data) {

        return http.post("/login", data)
    }

    update(data) {

        return http.put("/User", data)
    }

}

export default new PostUserDataService();