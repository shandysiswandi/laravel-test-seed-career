/**
 * Plain			: TELEGRAM
 *
 * step number 	: 3
 *
 * rule:
 *  1. dari depan ke belakang tergantung nilai k
 *  2. tidak boleh ada huruf yang sama ditempat yang sama
 *
 * step 1: T		    : `T` E L E G R A M     : index 0   ✅
 * step 2: TE		    : T E L `E` G R A M     : index 3   ✅
 * step 3: TEA			: T E L E G R `A` M     : index 6   ✅
 * step 4: TEAL			: T E `L` E G R A M     : index 2   ❓
 * step 5: TEALM	    : T E L E G R A `M`     : index 7   ❓
 * step 6: TEALMR		: T E L E G `R` A M     : index 5   ✅
 * step 7: TEALMRE		: T `E` L E G R A M     : index 1   ✅
 * step 8: TEALMREG		: T E L E `G` R A M     : index 4   ✅
 *
 * step 1: T	        : E L E G R A M
 * step 2: TE			: E L G R A M
 * step 3: TEA			: E L G R M
 * step 4: TEAL			: E G R M
 * step 5: TEALM		: E G R
 * step 6: TEALMR		: E G
 * step 7: TEALMRE		: G
 * step 8: TEALMREG		:
 *
 * encrypted 		:   TEALMREG
 */

/**
 * function to encrypt string with forward k
 *
 * @param {string} plain
 * @param {int} step
 * @return {string}
 */
function encrypt(plain, step) {
    let result = "";
    const used = [];

    let indexUsed = 0;
    for (let i = 0; i < plain.length; i++) {
        if (i == 0) {
            result = result + plain[0];
            used.push(0);
            continue;
        }

        let index = indexUsed + step;
        if (index > plain.length) {
            //
        }

        console.log("index ", plain[index]);

        if (plain[indexUsed + step] !== undefined) {
            result = result + plain[index];
            indexUsed = indexUsed + step;
        }
    }

    return result;
}

const plain = "TELEGRAM";
const step = 3;
const encrypted = encrypt(plain, step);

console.log("-------------------------------");
console.log(`Plain \t\t: ${plain}`);
console.log(`Step \t\t: ${step}`);
console.log(`Encrypted \t: ${encrypted}`);
console.log("-------------------------------");
