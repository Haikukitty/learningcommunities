(function() {
	var fullurl;
    tinymce.create('tinymce.plugins.eth_shortcodes', {
        init : function(ed, url) {
            fullurl = url;
            ed.addButton('eth_color', {
                title : 'Text Color',
                text: 'Text Color',
                onclick : function() {
                     ed.selection.setContent('[eth_color color="tomato"]' + tinyMCE.activeEditor.selection.getContent() + '[/eth_color]');
                }
            });
            ed.addButton('eth_empty', {
                title : 'Empty Space',
                text: 'Empty Space',
                onclick : function() {
                     ed.selection.setContent('[eth_empty]' + tinyMCE.activeEditor.selection.getContent() + '[/eth_empty]');
                }
            });
            ed.addButton('eth_divider', {
                title : 'Divider',
                text: 'Divider',
                onclick : function() {
                     ed.selection.setContent('[eth_divider]' + tinyMCE.activeEditor.selection.getContent() + '[/eth_divider]');
                }
            });
            ed.addButton('eth_clearfix', {
                title : 'Clearfix',
                text: 'Clearfix',
                onclick : function() {
                     ed.selection.setContent('[eth_clearfix]' + tinyMCE.activeEditor.selection.getContent() + '[/eth_clearfix]');
                }
            });
            ed.addButton('eth_col', {
                title : 'Columns',
                text: 'Columns',
                onclick : function() {
                     ed.selection.setContent('[eth_col size="1-3"]' + tinyMCE.activeEditor.selection.getContent() + '[/eth_col]');
                }
            });
            ed.addButton('eth_accordion', {
                title : 'Accordion',
                text: 'Accordion',
                onclick : function() {
                     ed.selection.setContent('[eth_accordion]' + tinyMCE.activeEditor.selection.getContent() + '[/eth_accordion]');
                }
            });
            ed.addButton('eth_accordion_item', {
                title : 'Accordion Item',
                text: 'Accordion Item',
                onclick : function() {
                     ed.selection.setContent('[eth_accordion_item]' + tinyMCE.activeEditor.selection.getContent() + '[/eth_accordion_item]');
                }
            });
            ed.addButton('eth_toggle', {
                title : 'Toggle',
                text: 'Toggle',
                onclick : function() {
                     ed.selection.setContent('[eth_toggle]' + tinyMCE.activeEditor.selection.getContent() + '[/eth_toggle]');
                }
            });
            ed.addButton('eth_tabsgroup', {
                title : 'Tabs Group',
                text: 'Tabs Group',
                onclick : function() {
                     ed.selection.setContent('[eth_tabsgroup]' + tinyMCE.activeEditor.selection.getContent() + '[/eth_tabsgroup]');
                }
            });
            ed.addButton('eth_tabsitem', {
                title : 'Tabs Item',
                text: 'Tabs Item',
                onclick : function() {
                     ed.selection.setContent('[eth_tabsitem]' + tinyMCE.activeEditor.selection.getContent() + '[/eth_tabsitem]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('eth_shortcodes', tinymce.plugins.eth_shortcodes);
})();