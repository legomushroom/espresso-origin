<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

/* -----------------------------------------------------------------------------
 * Page section field
 * -------------------------------------------------------------------------- */
if ( ! class_exists( 'RWMB_Page_section_Field' ) ) {
	class RWMB_Page_section_Field {
		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field ) {
			/*
			return sprintf(
				'<input type="text" class="rwmb-text" name="%s" id="%s" value="%s" size="%s" %s/>%s',
				$field['field_name'],
				$field['id'],
				$meta,
				$field['size'],
				!$field['datalist'] ?  '' : "list='{$field['datalist']['id']}'",
				self::datalist_html($field)
			);
			*/
			$section_content_id = preg_replace( '|[^a-z]|i', '', $field['id'].'-section-content' ); // Normalize id name o prevent editor malfunctions

			ob_start();
			?>
			<div id="<?php echo $field['id']; ?>" class="page-sections-editor">
				<div id="page-section-template">
					<li class="page-section">
						<div class="meta-box">
							<div class="toolbox">
								<button type="button" class="button edit-button">Edit</button>
								<button type="button" class="button delete-button">Delete</button>
							</div>
							
							<div class="section-name">SECTION TITLE</div>
							<div class="clearfix"></div>
						</div>
					</li>
				</div>

				<div id="page-section-options" class="page-section-options modal hide" aria-hidden="true" role="dialog" data-section-content-id="<?php echo $section_content_id; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Page Section Options</h4>
							</div>
							<div class="modal-body">
								<table class="form-table ">
									<tbody>
										<tr valign="top">
											<th scope="row">
												<label for="section-id">Section ID <span class="optional">(optional)</span></label>
											</th>
											<td scope="row">
												<input name="section-font-color" id="section-id" type="text" class="">
											</td>
										</tr>
										<tr valign="top">
											<th scope="row" colspan="2">
												<label for="section-content">Text / HTML</label>
											</th>
										</tr>
										<tr valign="top">
											<td scope="row" colspan="2">
												<?php wp_editor( '', $section_content_id, array( 'textarea_name'=>$section_content_id, 'editor_height'=>'250' ) ); ?>
											</td>
										</tr>
										<tr valign="top">
											<th scope="row">
												<label for="section-layout">Layout</label>
											</th>
											<td>
												<select name="section-layout" id="section-layout">
													<option value="content-width" selected="selected">Content width</option>
													<option value="full-width">Full width</option>
												</select>
											</td>
										</tr>
										<tr valign="top">
											<th scope="row">
												<label for="">Padding</label>
											</th>
											<td>
												<label for="padding-top">Top : </label>
												<input name="section-padding-top" id="section-padding-top" type="number" step="1" value="0" class="section-padding-top">

												<label for="padding-top">Bottom : </label>
												<input name="section-padding-bottom" id="section-padding-bottom" type="number" step="1" value="0" class="section-padding-bottom">
											</td>
										</tr>
										<tr valign="top">
											<th scope="row">
												<label for="section-font-color">Font Color</label>
											</th>
											<td>
												<input name="section-font-color" id="section-font-color" type="text" class="color-picker">
											</td>
										</tr>
										<tr valign="top">
											<th scope="row">
												<label for="section-background-color">Background Color</label>
											</th>
											<td>
												<input name="section-background-color" id="section-background-color" type="text" class="color-picker">
											</td>
										</tr>
										<tr valign="top">
											<th scope="row">
												<label for="section-background-image">Background Image</label>
											</th>
											<td>
												<button type="button" class="button select-bg-button"><i class="icon-picture"></i> Choose image</button>
												<button type="button" class="button remove-bg-button"><i class="icon-remove"></i> Remove image</button>
												<br>
												<select name="section-background-effect" id="section-background-effect" style="margin-top: 10px;">
													<option value="no" selected="selected">No Background Effect</option>
													<option value="parallax">Parallax Background</option>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="save-page-section button button-primary">Save changes</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->

				<button type="button" class="button add-section-button"><i class="icon-plus"></i> Section</button>
				<input type="hidden" id="page-sections-data" name="<?php echo $field['field_name']; ?>" value='<?php echo esc_attr( $meta ); ?>'>
				<ul class="page-sections"></ul>
			</div>
			<?php
			return ob_get_clean();
		}

		function validate() {
			global $allowedposttags;
			$this->value = wp_kses( $this->value, $allowedposttags );
		}
	}
}
