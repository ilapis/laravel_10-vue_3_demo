export const translationTableSettings = [
    {
        'column': 'id',
        'width': '80px',
        'frozen': true,
    },
    {
        'column': 'language_id',
        'title': 'language',
        'width': '145px',
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
        'column': 'created_at',
        'width': '200px',
    },
    {
        'column': 'updated_at',
        'width': '200px',
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
