import './editor.scss';
import './style.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks


registerBlockType( 'cgb/block-my-block', {
	title: __( 'Easy Casino Table' ), 
	icon: 'money-alt', 
	category: 'common', 
	keywords: [
		__( 'Easy Casino Table' ),
		__( 'Casino Table' ),
		__( 'create-guten-block' ),
	],
	attributes: {
		casinos: {
			type: 'object'
		},
		selectedCasino: {
			type: 'string'
		},
	},

	edit: function( props ) {
		
		if( ! props.attributes.casinos){
			wp.apiFetch({
				url: '/wp-json/wl/v1/ect-casino'
			} ).then( ect => {
				props.setAttributes( {
					casinos: ect
				});
			});
		}
	
		console.log( props.attributes );


		if( ! props.attributes.casinos ){
			return 'Loading...';
		}

		function updateCasino( e ) {
			props.setAttributes( {
				selectedCasino: e.target.value,
			} );
		}

		return (
			<div>
				<select onChange = { updateCasino } value = { props.attributes.selectedCasino }>
				<option>Select Item</option>
					{
						props.attributes.casinos.map( casino => {
							return (
								<option value = { casino.id } key = { casino.id }>
									{ casino.title }
								</option>
							);
						})
					}
				</select>
			</div>
		);
	},
	save: function() {
		return null;
	},
} );
