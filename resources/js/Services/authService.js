import useHttp from '@/Helpers/useHttp.js';

const { post } = useHttp();

class AuthService {
    constructor(router) {
        this.router = router;
    }

    async login(form) {
        const response = await post('/api/v1/auth/login', form);

        if (response?.authorization?.token) {
            localStorage.setItem('token', response?.authorization?.token)
            if (response?.authorization?.abilities) {
                localStorage.setItem('abilities', response?.authorization?.abilities)
            }
            await this.router.push({name: 'admin-dashboard'})
        }

        return response;
    }

    async logout() {
        await post('/api/v1/auth/logout');
        localStorage.removeItem('token');
        this.router.push({ name: 'admin' });
    }
}

export default AuthService;
