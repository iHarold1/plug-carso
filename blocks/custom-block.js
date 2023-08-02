(function (blocks, editor, i18n, element) {
    var el = element.createElement;
    var registerBlockType = blocks.registerBlockType;
    var RichText = editor.RichText;
    var __ = i18n.__;

    registerBlockType('plug-carso/custom-block', {
        title: __('Custom Block'),
        icon: 'format-status',
        category: 'common',
        attributes: {
            title: {
                type: 'string',
            },
            description: {
                type: 'string',
            },
        },
        edit: function (props) {
            var title = props.attributes.title;
            var description = props.attributes.description;

            var onChangeTitle = function (newTitle) {
                props.setAttributes({ title: newTitle });
            };

            var onChangeDescription = function (newDescription) {
                props.setAttributes({ description: newDescription });
            };

            return el('div', { className: props.className },
                el(RichText, {
                    tagName: 'h2',
                    value: title,
                    onChange: onChangeTitle,
                    placeholder: __('Enter title...'),
                }),
                el(RichText, {
                    tagName: 'p',
                    value: description,
                    onChange: onChangeDescription,
                    placeholder: __('Enter description...'),
                })
            );
        },
        save: function (props) {
            return el('div', { className: props.className },
                el(RichText.Content, {
                    tagName: 'h2',
                    value: props.attributes.title,
                }),
                el(RichText.Content, {
                    tagName: 'p',
                    value: props.attributes.description,
                })
            );
        },
    });
})(
    window.wp.blocks,
    window.wp.editor,
    window.wp.i18n,
    window.wp.element
);
