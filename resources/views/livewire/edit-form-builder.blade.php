<?php
$data = json_encode($this->form_template->content);
?>
<div>

    <input type="hidden" id="hide_me" value="{{ $data }}">
    <label for="name" style="font-weight: bold; font-size: 20px">Name :</label>
    <br>
    <input type="text" id="name" name="name" class="form-control" wire:model="name"
        style="margin-bottom: 2rem; border-radius: 5px; margin-top: 0.5rem;" />



    <div id="fb-editor"></div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script>
    setTimeout(() => {
        $(document).ready(function() {
            let form = document.getElementById("hide_me");
            var fbEditor = document.getElementById('fb-editor');

            var fields = [{
                label: "Email",
                type: "text",
                subtype: "email",
                icon: "✉"
            }, ];
            var reg = [];
            var town = [];
            var qua = [];
            var nrc = [];


            var regions = <?php echo json_encode($regions); ?>;
            var township = <?php echo json_encode($townships); ?>;
            var quarter = <?php echo json_encode($quarters); ?>;
            var nrcs = <?php echo json_encode($nrcs); ?>;


            for (const key in regions) {
                reg = [...reg,
                    {
                        label: regions[key],
                        value: key,

                    }
                ]
            }
            for (const key in township) {
                town = [...town,
                    {
                        label: township[key],
                        value: key,

                    }
                ]
            }
            for (const key in quarter) {
                qua = [...qua,
                    {
                        label: quarter[key],
                        value: key,

                    }
                ]
            }
            for (const key in nrcs) {
                nrc = [...nrc,
                    {
                        label: nrcs[key],
                        value: key,

                    }
                ]
            }



            console.log(regions);
            var inputSets = [{
                    label: 'Address',
                    name: 'address',
                    showHeader: true,
                    icon: "&#x1F3E0",
                    fields: [{
                            type: 'select',
                            label: 'Region',
                            className: 'form-control',
                            values: reg,

                        },
                        {
                            type: 'select',
                            label: 'Township',
                            className: 'form-control',
                            values: town
                        },
                        {
                            type: 'select',
                            label: 'Quarter',
                            className: 'form-control',
                            values: qua
                        },
                    ]
                },
                {
                    label: 'NRC',
                    showHeader: true,
                    icon: "&#9605;",
                    fields: [{
                            type: 'select',
                            label: 'NRC code',
                            className: 'form-control',
                            values: [{
                                    label: '1/',
                                    value: '1/',
                                    selected: false
                                },
                                {
                                    label: '2/',
                                    value: '2/',
                                    selected: false
                                },
                                {
                                    label: '3/',
                                    value: '3/',
                                    selected: false
                                },
                                {
                                    label: '4/',
                                    value: '4/',
                                    selected: false
                                },
                                {
                                    label: '5/',
                                    value: '5/',
                                    selected: false
                                },
                                {
                                    label: '6/',
                                    value: '6/',
                                    selected: false
                                },
                                {
                                    label: '7/',
                                    value: '7/',
                                    selected: false
                                },
                                {
                                    label: '8/',
                                    value: '8/',
                                    selected: false
                                },
                                {
                                    label: '9/',
                                    value: '9/',
                                    selected: false
                                },
                                {
                                    label: '10/',
                                    value: '10/',
                                    selected: false
                                },
                                {
                                    label: '11/',
                                    value: '11/',
                                    selected: false
                                },
                                {
                                    label: '12/',
                                    value: '12/',
                                    selected: false
                                },
                                {
                                    label: '13/',
                                    value: '13/',
                                    selected: false
                                },
                                {
                                    label: '14/',
                                    value: '14/',
                                    selected: false
                                }

                            ]
                        },
                        {
                            type: 'select',
                            label: 'KAKATA',
                            className: 'form-control',
                            values: nrc
                        },
                        {
                            type: 'select',
                            label: 'National Type',
                            className: 'form-control',
                            values: [{
                                    label: 'N',
                                    value: 'option-2',
                                    selected: false
                                },
                                {
                                    label: 'E',
                                    value: 'option-3',
                                    selected: false
                                },
                                {
                                    label: 'P',
                                    value: 'option-3',
                                    selected: false
                                }
                            ]
                        },
                        {
                            "type": "number",
                            "label": "NRC Number",
                            "className": "form-control",
                            "min": 0,
                            "max": 999999

                        },
                    ]
                }
            ];

            // Function to initialize the form builder with data
            function initializeFormBuilder(data) {
                $(fbEditor).formBuilder({
                    formData: data,
                    fields: fields,
                    inputSets: inputSets,
                    onSave: function(evt, formData) {

                        @this.dispatch('update', {
                            content: formData
                        });
                    },
                });
            }

            // Fetch data and initialize form builder
            var fetchDataPromise = new Promise(function(resolve) {
                // Simulate data fetching, replace this with your actual data fetching logic

                var formData = JSON.parse(form.value);
                resolve(formData);

            });
            fetchDataPromise.then(function(data) {
                initializeFormBuilder(data);
            });
        });
    }, 50);
</script>
