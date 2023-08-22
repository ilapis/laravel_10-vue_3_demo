export const createQueryString = (types, values) => {
    let queryParams = [];

    for (const [key, filterArray] of Object.entries(types)) {
        const filterType = filterArray[0];
        const value = values[key];

        if (filterType === "contains" && value) {
            queryParams.push(`contains[${key}]=${encodeURIComponent(value)}`);
        } else if (filterType === "is_null" && value !== undefined) {
            queryParams.push(`is_null[${key}]=${value ? 1 : 0}`);
        }
    }

    return queryParams.join('&');
};

export const initializeFilters = (store, filters3) => {

    const params = new URLSearchParams(store._setFilters);
    const filters2 = {};
    for (const [key, value] of params.entries()) {
        filters2[key] =  value;
    }

    if (store._setFilters && store._setFilters.includes('deleted_at')) {
        if (filters2['is_null[deleted_at]'] == 1) {
            filters3.value['deleted_at'] = true;
        }
    }

    let filterable = store.collection?.filterable;
    for (const key in filterable) {
        if (Object.prototype.hasOwnProperty.call(filterable, key)) {
            const value = filterable[key];
            if (filters2[`${value}[${key}]`] !== undefined) {
                filters3.value[key] = filters2[`${value}[${key}]`];
            }
        }
    }
}
