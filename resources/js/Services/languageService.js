import useHttp from '@/Helpers/useHttp.js';

const { get, post } = useHttp();

class LanguageService {
    async all() {
        const response = await get('/api/v1/language');

        return response;
    }

    async page(page) {
        const response = await get(`/api/v1/language?page=${page}`);

        return response;
    }
}

export default LanguageService;
