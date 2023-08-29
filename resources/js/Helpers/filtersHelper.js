export const createQueryString = (types, values) => {
    let queryParams = [];

    for (const [key, filterArray] of Object.entries(types)) {

        const record = values[key];
        const filterType = record.matchMode;
        const value = record.value;

        if (filterType !== null && value !== null) {
            const filterMap = {
                "contains": "contains",
                //"dateMin": "date_min",
                //"dateMax": "date_max",
                "endsWith": "ends_with",
                "exact": "exact",
                "equals": "exact",
                //TODO has in filter
                //TODO in filter
                "min": "min",
                "max": "max",
                "notEqual": "not_equal",
                //TODO not in filter
                "startsWith": "starts_with",
                "notContains": "not_contains",//TODO not_contains
                "yearExact": "year_exact",
                "yearMax": "year_max",
                "yearMin": "year_min",
            };

            for (const [keyInFilter, queryParam] of Object.entries(filterMap)) {
                if (filterType.includes(keyInFilter)) {
                    queryParams.push(`${queryParam}[${key}]=${encodeURIComponent(value)}`);
                }
            }
            if (filterType.includes("is_null") && value !== undefined) {
                queryParams.push(`is_null[${key}]=${value ? 1 : 0}`);
            }
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
