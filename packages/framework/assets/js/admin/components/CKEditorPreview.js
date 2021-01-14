import Register from '../../common/utils/Register';
import Translator from 'bazinga-translator';

export default class CKEditorPreview {

    constructor ($ckEditorPreview) {
        const expandText = Translator.trans('... expand ...');
        const collapseText = Translator.trans('collapse');

        const $expandButton = $ckEditorPreview.siblings('.js-cke-preview-expand');

        if (this.isOverflown($ckEditorPreview)) {
            $expandButton.show();
        }

        $ckEditorPreview.click(() => {
            $ckEditorPreview.hide();
            $expandButton.hide();
        });

        $expandButton.click(() => {
            $ckEditorPreview.toggleClass('cke-preview-text-collapsed');
            $expandButton.toggleClass('cke-preview-expand-button-collapsed');
            this.toggleText($expandButton, expandText, collapseText);
        });
    }

    toggleText ($element, originalText, alternateText) {
        let text = $element.text();
        $element.text(text === originalText ? alternateText : originalText);
    }

    isOverflown ($element) {
        return $element[0].scrollHeight > $element[0].clientHeight;
    }

    static init ($container) {
        $container.filterAllNodes('.js-cke-preview').each(function () {
            // eslint-disable-next-line no-new
            new CKEditorPreview($(this));
        });
    }
}

(new Register()).registerCallback(CKEditorPreview.init, 'CKEditorPreview.init');
