export const languageTableSettings = [
    {
        'column': 'id',
        'width': '80px',
        'frozen': true,
    },
    {
        'column': 'code',
        'title': 'language_code',
        'frozen': true,
    },
    {
        'column': 'name',
        'title': 'language',
    },
    {
        'column': 'enabled',
    },
    {
        'column': 'created_at',
        'width': '200px',
        'class': 'hide-b-720',
    },
    {
        'column': 'updated_at',
        'width': '200px',
    },
    {
        'type': 'component',
        'width': '100px',
        'component': 'LanguageEditModal',
        'frozen': true,
        'alignFrozen': 'right',
    },
    {
        'type': 'component',
        'width': '135px',
        'component': 'DeleteModal',
        'frozen': true,
        'alignFrozen': 'right',
    },
];
