export const translationTableSettings = [
    {
        'column': 'translations.id',
        'title': 'id',
        'width': '80px',
        'frozen': true,
    },
    {
        'column': 'language.name',
        'title': 'language',
        'width': '145px',
        'filter': 'LanguageFilter',
    },
    {
        'column': 'group',
        'title': 'group',
        'width': '120px',
    },
    {
        'column': 'key',
        'title': 'key',
    },
    {
        'column': 'value',
        'title': 'value',
    },
    {
        'type': 'component',
        'width': '100px',
        'component': 'TranslationEditModal',
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
