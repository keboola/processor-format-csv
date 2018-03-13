# processor-format-csv

[![Build Status](https://travis-ci.org/keboola/processor-format-csv.svg?branch=master)](https://travis-ci.org/keboola/processor-format-csv)

Processes CSV files into exotic formats for writers. Typical use case is converting RFC4180 formated CSV from KBC into "TSV without encapulators" or "pipe separated file". 

Does not support sliced tables. Does not allow to set custom escape character (double encapsulator is used automatically). 

# Usage

CSV files in the input folder are parsed according to their respective manifest files and written to output folder with new delimiter and encapsulator, along with new updated manifest file. 

Example config that converts to TSV without encapsulators:

```json
{
    "definition": {
        "component": "keboola.processor-format-csv"
    },
    "parameters": {
        "delimiterTo": "\t",
        "enclosureTo": ""
    }
}
``` 

For more information about processors, please refer to [the developers documentation](https://developers.keboola.com/extend/component/processors/). 

*Note:* The input file manifest is mandatory. You may need to prepend [Create Manifest processor](https://github.com/keboola/processor-create-manifest) to your processors pipeline. 

## Development
 
Clone this repository and init the workspace with following command:

```
git clone https://github.com/keboola/processor-format-csv
cd processor-format-csv
docker-compose build
docker-compose run --rm dev composer install --no-scripts
```

Run the test suite using this command:

```
docker-compose run --rm dev composer tests
```
 
# Integration

For information about deployment and integration with KBC, please refer to the [deployment section of developers documentation](https://developers.keboola.com/extend/component/deployment/) 
