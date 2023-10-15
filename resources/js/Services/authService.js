import http from "@/http.js";

class AuthService {
    constructor(router) {
        this.router = router;
    }

    async login(form) {

        return http.post(`/api/v1/auth/login`, form).then((response) => {

            if (response?.data?.authorization?.token) {
                //localStorage.setItem('token', response?.data?.authorization?.token)
                if (response?.data?.authorization?.abilities) {
                    localStorage.setItem('abilities', response.data?.authorization.abilities)
                }
                if (response?.data?.authorization?.expires_at) {
                    localStorage.setItem('token_expires_at', response.data?.authorization.expires_at)
                }
                this.router.push({name: 'admin-languages'})
            }

            return response.data;
        });
    }

    async logout() {
        await http.post(`/api/v1/auth/logout`);
        //localStorage.removeItem('token');
        this.router.push({ name: 'admin' });
    }
}

export default AuthService;
