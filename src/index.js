// imports
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { RichText } from '@wordpress/block-editor';

// translation
import { __ } from '@wordpress/i18n';

// css
import './style.scss';
import './editor.scss';


registerBlockType( 'us/starter-block', {
	apiVersion: 2,
	title: __( 'Starter Block', 'starter-block' ),
	description: __(
		'Example block written with ESNext standard and JSX support – build step required.',
		'starter-block'
	),
	category: 'common',
	icon: 'info-outline',
	supports: {
		// Removes support for an HTML mode.
		html: false,
	},
	attributes: {
        content: {
            type: 'string',
            source: 'html',
            selector: 'p',
        },
    },
 
	edit: ( { attributes, setAttributes } ) => {	
		const blockProps = useBlockProps();
				     
		return (
			
			<RichText	
				{ ...blockProps }			
				tagName="p"
				value={ attributes.content }
				formattingControls={ [ 'bold', 'italic' ] }
				onChange={ ( content ) => setAttributes( { content } ) }
				placeholder={ __( 'Heading...' ) }
			/>	
			
		);
    },
 
    save: ( { attributes } ) => {
		const blockProps = useBlockProps.save();
		return (	
			
			<RichText.Content { ...blockProps } tagName="p" value={ attributes.content } />						
			
		);
    },

} );
