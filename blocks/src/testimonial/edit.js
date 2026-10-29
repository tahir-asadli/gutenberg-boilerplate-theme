/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __, sprintf } from '@wordpress/i18n';
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import {
	InspectorControls, useBlockProps, useInnerBlocksProps, MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */

import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */


const MAX_CHARS = 200;
export default function Edit({ attributes, setAttributes }) {
	const { name, title, quote, imageId, imageUrl, imageAlt } = attributes;
	const onSelect = (media) => {
		setAttributes({
			imageId: media.id,
			imageUrl: media.sizes?.medium?.url || media.url,
			imageAlt: media.alt || '',
		});
	};
	const onRemove = () => {
		setAttributes({ imageId: undefined, imageUrl: '', imageAlt: '' });
	}
	const blockProps = useBlockProps({});
	const innerBlocksProps = useInnerBlocksProps(blockProps);
	return (
		<>
			<InspectorControls group='settings'>
				<PanelBody title={__('Testimonial info', 'gutenberg-boilerplate')}>
					<TextControl
						label={__('Name', 'gutenberg-boilerplate')}
						value={name}
						onChange={(value) => setAttributes({ name: value })}
						__next40pxDefaultSize
					/>
					<TextControl
						label={__('Title', 'gutenberg-boilerplate')}
						value={title}
						onChange={(value) => setAttributes({ title: value })}
						__next40pxDefaultSize
					/>
					<TextareaControl
						label={__('Quote', 'gutenberg-boilerplate')}
						value={quote}
						onChange={(value) =>
							setAttributes({
								quote: value.slice(0, MAX_CHARS),
							})
						}
						maxLength={MAX_CHARS}
						rows={5}
						help={sprintf(
							/* translators: 1: characters used, 2: maximum */
							__('%1$d / %2$d characters', 'gutenberg-boilerplate'),
							quote.length,
							MAX_CHARS
						)}
					/>
					{imageUrl &&
						<img src={imageUrl} alt={imageAlt} />
					}
					<MediaUploadCheck>
						<MediaUpload
							onSelect={onSelect}
							allowedTypes={['image']}
							value={imageId}
							render={({ open }) => (
								<Button variant="secondary" onClick={open}>
									{imageUrl
										? __('Replace image', 'gutenberg-boilerplate')
										: __('Choose image', 'gutenberg-boilerplate')}
								</Button>
							)}
						/>
					</MediaUploadCheck>
					{imageUrl && (
						<>
							<Button
								variant="link"
								isDestructive
								onClick={onRemove}
								style={{ marginLeft: 12 }}
							>
								{__('Remove', 'gutenberg-boilerplate')}
							</Button>
						</>
					)}
				</PanelBody>
			</InspectorControls>
			<div {...innerBlocksProps}>
				{!name && !title && !quote && !imageUrl ? (
					<p style={{ opacity: 0.6 }}>
						{__('Add testimonial text in the sidebar…', 'gutenberg-boilerplate')}
					</p>
				) : null}
				{name && <h3>{name}</h3>}
				{title && <h4>{title}</h4>}
				{quote && <p>{quote}</p>}
				{imageUrl && <img src={imageUrl} alt={imageAlt} />}
			</div>
		</>
	);
}
