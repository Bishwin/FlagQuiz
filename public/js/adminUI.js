// MODEL of country
var Country = Backbone.Model.extend({
    defaults:{
        id: null,
        name: null,
        flag: null,
    }
});

// COLLECTION of country
var Countries = Backbone.Collection.extend({
    model: Country,
    url: 'https://w1441879.users.ecs.westminster.ac.uk/604cwk2/index.php/api/country'
	
});

// Create COLLECTION
var countries = new Countries([]);

// VIEW for a country
var CountryView = Backbone.View.extend({
    model: new Country(),
    tagName: 'tr',
    initialize: function(){
        this.template = _.template($('.country-list-template').html());
    }, 
    events: {
        'click .edit-country': 'edit',
        'click .update-country': 'update',
		'click .delete-country': 'delete',
        'click .cancel': 'cancel'
	},
    // For editing a country
    edit: function() {
        // hide first set of buttons
		$('.edit-country').hide();
		$('.delete-country').hide();
        // display update and cancel buttons only for this element/model
		this.$('.update-country').show();
		this.$('.cancel').show();

        // store values already present
		var countryName = this.$('.countryName').html();
		var flag_url = this.$('.flag-url').html();

        // add them into the new editable boxes
		this.$('.countryName').html('<input type="text" class="form-control countryName-update" value="' + countryName + '">');
		this.$('.flag-url').html('<input type="text" class="form-control flag-url-update" value="' + flag_url + '">');
	},
    update: function() {
		this.model.set('name', $('.countryName-update').val());
		this.model.set('flag', $('.flag-url-update').val());

		this.model.save(null,{
            wait: true,
            url: 'https://w1441879.users.ecs.westminster.ac.uk/604cwk2/index.php/api/country?id=' + this.model.id,
			success: function(response) {
				console.log('Successfully UPDATED' );
			},
			error: function(err) {
				console.log('Failed to update');
			}
		});
	},
	delete: function() {
		this.model.destroy({
            wait: true,
            url: 'https://w1441879.users.ecs.westminster.ac.uk/604cwk2/index.php/api/country?id=' + this.model.id,
			success: function(response) {
				console.log('Successfully DELETED');
			},
			error: function(err) {
				console.log('Failed to delete');
			}
		});
	},
	cancel: function() {
		countryview.render();
	},
    render: function(){
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});

// VIEW for all countries
var CountriesView = Backbone.View.extend({
    model: countries,
    el: $('.country-list'),
    initialize: function(){
        var self = this;
        //this.listenTo(this.model, 'add', this.render);
        this.model.on('add', this.render, this);
        this.model.on('change', function() {
			setTimeout(function() {
				self.render();
			}, 30);
		},this);
		this.model.on('remove', this.render, this);
        this.model.fetch({
            success: function(response){
                _.each(response, function(item){
                    console.log('success')
                })
      },
      error: function(){
          console.log('failed')
      }
    });
  },
  render: function(){
    var self = this;
    this.$el.html('');
    _.each(this.model.toArray(), function(country) {
      self.$el.append((new CountryView({model: country})).render().$el);
    });
    return this;
  }
});

// CREATE views
var countryview = new CountriesView();

$(document).ready(function() {
	$('.add-country').on('click', function() {
		var country = new Country({
			name: $('.countryName-input').val(),
			flag: $('.flag-url-input').val()
		});
		$('.countryName-input').val('');
		$('.flag-url-input').val('');
		countries.add(country);
		country.save(null, {
            wait: true,
			success: function(response) {
				console.log('Successfully SAVED');
			},
			error: function() {
				console.log('Failed to save');
			}
		});
	});
})