<data>
	{% for contact in contacts %}
        <item id="{{ contact.id }}" firstname="{{ contact.firstname }}" lastname="{{ contact.lastname }}" address_1="{{ contact.address1 }}" address_2="{{ contact.address2 }}" postal="{{ contact.postal }}" city="{{ contact.city }}" tel_home="{{ contact.tel }}" tel_mobile="{{ contact.tel2 }}"></item>
    {% endfor %}
</data>