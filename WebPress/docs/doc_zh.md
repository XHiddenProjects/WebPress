[原始文檔](../docs/doc_en.md)

# 網絡出版社

一個簡單的 CMS，使用 JSON 數據庫並用於所有網頁，包括域和本地主機

### [這是什麼？](./docs#這是什麼) {#這是什麼}

這是一個簡單的 CMS，允許您使用 User Infrence(UI) 並允許使用高質量的 SEO 信息和簡單的構建結構更輕鬆地進行搜索。 這使用 JSON 文件在您的網頁上製作/創建頁面。 您的頁面由書面代碼構建，然後將其轉換為 JSON 文件。

***

### [要求](./docs#requirements) {#requirements}

＃＃＃＃＃＃ 系統要求
- PHP 7.4 或更高版本
- 網絡服務器（阿帕奇）
###### PHP 擴展
- 用於圖像處理的 PHP [GD](http://php.net/manual/en/book.mbstring.php) 模塊。
- 用於 JSON 操作的 PHP [JSON](https://php.net/manual/en/book.json.php) 模塊。
- PHP [mbstring](http://php.net/manual/en/book.mbstring.php) 模塊提供完整的 UTF-8 支持。

***

### [基礎知識](./docs#basics) {#basics}

一旦您訪問此 url `http(s)://{your_domain}/` 或 `http(s)://{your_domain}/{folder}`，這些基礎知識就很簡單，有 2 **HTACCESS** 將有 1 個是您的主（WebPress）頁面，另一個將是您網站的*您的主頁*。 這將在它自己的獨立文件夾中。

***

### [如何安裝？](./docs#how-to-install) {#how-to-install}

要安裝，只需將 *Un-ZIPED* 文件夾插入 *HTDocs（根文件夾）* 即可開始運行軟件。 完成後轉到 `http(s)://{your_domain}/` 或添加 `./{folder}/` 以訪問主 WebPress 頁面**推薦：htdocs**。 在那里之後，首先配置您的創建帳戶後_**（這將在第一次註冊時默認為管理員，之後您將成為會員）**_。

***

### [更新版本](./docs#updating) {#updating}
1. 備份您的數據，以免損壞任何東西。
2. 徹底刪除“舊版本”文件夾。
3. 完成後，註冊一個新帳戶以進行任何更改。
4. 將數據重新加載到數據和配置文件夾中（可以使用備份插件進行備份）

***

### [角色](./docs#roles) {#roles}

角色很重要，它們是非常可定制的，有 3 個主要角色，*admin、mod 和 member* 這將使用戶具有不同的訪問權限。

`admin`，完全控制人們如何查看和查看更改和通知。 也可以讓 `mod` 幫助編輯頁面並使事情變得更好。 編輯插件和更改主題等。通過_name_ 或_ip_ 禁止用戶。

`mod` 可以通過訪問編輯器（如果 `admin` 允許）來幫助 `admin` 使頁面更好。 他們還可以報告任何可疑活動，“管理員”會收到它。

`member` 只能查看和使用頁面元素。

`guest`是未註冊/登錄時的默認賬號，只能查看和閱讀數據。

查看 [職位文檔](#jobs)，了解您可以對用戶狀態執行的操作。

***

### [錯誤頁面](./docs#error-pages) {#error-pages}

您可以在 [_dashboard.php/configs_](./configs) 中製作自定義錯誤頁面並製作自定義錯誤，以便您的頁面可以顯示一些內容，而不是無聊的舊錯誤頁面。

錯誤文檔列表（可編輯）

1. 400 - 錯誤請求
2. 401 - 需要授權
3. 403 - 禁止訪問
4. 404 - 未找到
5. 500 - 內部服務器錯誤

***

### [工作](./docs#jobs) {#jobs}

以適度角色的形式。 這是一張默認給你的表

| 標籤 | 目標 | 風俗？ |
| ---- | ------ | ---------- |
| 管理員| 第一筆收入 | × |
| 版主 | 指定用戶 | × |
| 會員 | 註冊用戶 | × |
| 客人 | 未知用戶 | × |

如果您想添加自己的，請轉到 _ROLES.json_

輸入此代碼
將 `[obj]` 更改為類型名稱，同時更改 true/false 以允許或禁止該權限。
```json
“[對象]”：{
"name": "[objname]",
“描述”：“[objdesc]”，
“選項”：{
“視圖”：真實的，
“寫”：是的，
“讀”：假的，
“刪除”：假的，
“禁令”：假的，
“警告”：假的，
“帖子”：假的，
“回复”：假的，
“onComingMessages”：假的，
“activePlugins”：假的，
“activeThemes”：假的，
“配置”：假的，
“改變角色”：假的，
“文件管理器”：假的，
“更改配置文件”：假
}
}
```

### [編輯](./docs#editors) {#editors}

該項目使用的編輯器是 __BBCode__、__Markdown__ 和 __WYSIWYG__

### [公鑰與私鑰](./docs#public-vs-private-key) {#public-vs-private-key}

公鑰是您將用於配置需要該密鑰的任何插件的內容，
私鑰是用於備份登錄的，從不同的位置使用它來訪問它。
公鑰允許您使用插件和主題來獲取用戶信息。

### [鉤子](./docs#hooks) {#hooks}

使用鉤子，您可以攔截各種 WebPress 事件以注入您自己的代碼。

以下是可用掛鉤的列表：

| 鉤 | 碰到 | 使用 |
| ---- | ---------- | ---- |
| Profile | `主題` | 出現在您的個人資料頁面 |
| edit_profile | `主題` | 在配置文件編輯器上編輯 |
| head | `主題` | 在 __head__ | 標籤中運行
| nav | `主題` | 出現在導航欄 |
| editor | `主題` | 出現在編輯欄 |
| footerJS | `主題` | 執行頁腳中的代碼（作為 __Javascript__） |
| footer | `主題` | 執行頁腳中的代碼 |
| dblist | `核心` | 出現在儀表板列表中 |
| beforePage | `核心` | 在頁面加載前執行代碼 |
| afterPage | `核心` | 頁面加載後 escode utes |
| replyBottom | `核心` | 出現在回复消息的底部 |
| init | `核心` | 在加載所有內容之前運行 |
| profileCards_box | `論壇` | 出現在“配置文件選項卡”窗格中 |
| profileCards_btn | `論壇` | 出現在“配置文件選項卡”按鈕組中 |
| beforeMsg | `論壇` | 在加載消息之前顯示 |
| afterMsg | `論壇` | 加載消息後顯示 |
| bottomReply | `論壇` | 顯示在回复消息的底部 |
| bottomTopic | `論壇` | 顯示在主題消息的底部 |

### [禁令](./docs#bans) {#bans}

封禁應該在後面使用，但你（管理員）將擁有這樣做的所有權限，你有 3 種方式來封禁用戶

###### __禁令：__
1.知識產權
2.用戶名
3. 硬件ID(Hard Ban)

它可以是臨時的，通過使用 (`m-d-Y H:i:s`) 格式或類型 (`-1`) _unlimited_ 時間

### [工具包](./docs#toolkits) {#toolkits}

工具包在很多情況下都非常有用，這可以通過執行以下操作對_plugins_起作用

在 `{plugin_name}.plg.php` 中插入：

```PHP
<?php
include_once(ROOT.'/libs/toolkit.lib.php');
# 使用 `toolkits` 作為 TOOLKIT；
使用 WebPress\toolkits 作為工具包；
#加載工具包
$套件=新工具包（）；
# 函數（這些是默認選擇器，讓 pramaters 為 null 以僅使用默認值）
$kit->useColor($color='黑色');
$kit->useFontWeight($fontWeight='bold');
$kit->useFontStyle($fontStyle='italic');
$kit->useFontSize($fontStyle=25, $units='px');
$kit->setAllies($func, $parma=null);
＃ 轉變
$kit->__toBool($txt);
$kit->__toStr($txt);
$kit->__toInt($txt);
$kit->__toFloat($txt);
？>
```

### [文件上傳](./docs#file-uploading) {#file-uploading}
文件上傳也有它的局限性，你可以上傳任何東西，但有些項目不能編輯（例如圖像、視頻等）。
最大上傳大小是您的服務器可以處理的任何大小。 您可以上傳任何文件類型，有些可能是可編輯的，有些可能不可編輯，盡量不要上傳任何可能帶有允許訪問帳戶的注入軟件的文件。
在'論壇'上傳項目的用戶是有限的（在`config`文件夾中查看）

### [論壇搜索](./docs#forum-searching) {#forum-searching}
論壇搜索一個高級工具來更容易地找到東西，但它必須包含一個關鍵工作才能讓它工作
例如，_(tags:fun)_，語法模式是`{selector}:{value}`

允許的選擇器：
* 標籤
* 論壇
* 話題
* 地位

### [主題](./docs#themes) {#themes}
主題使軟件看起來像它看起來的樣子，它易於設置和配置。

這是你如何設置它。
1. 複製 _theme 文件夾_ 中的“Default”文件夾（這是必需的，因為大多數文件夾都需要這樣做）。
2. 進入 `theme.conf.json` 並更改任何需要更改的內容。
3. 享受吧，開始將 css/js 代碼放入您的文件夾並為您的頁面設置樣式。

### [政策](./docs#policy) {#policy}


##### WebPress - 政策

歡迎使用 WebPress，一個免費的開源自託管 CMS 和 Forum-Script。 作為一名開發人員（我自己）喜歡製作供任何人使用和合理使用數據的軟件，因為這被歸類為_社交媒體_平台，我可以告訴你社交媒體已經失控，濫用權力而且不恰當 節制。 所以即使這允許你說出你喜歡什麼，我也會加入成為一個 **_second-hand moderation_** 閱讀更多...

  

#### 允許

* 分享您的意見
* 分享您的想法/要求
* 政治/術語理想
* 銷售產品或推廣您的選擇（確保它是合適的）
* 上傳/發布你喜歡的任何內容（確保它是合適的）
* 回復任何你喜歡的

  

#### 不允許

* 銷售非法物品：（18 U.S. Code § 1170）
* 虐待兒童/色情：虐待兒童：（美國法典第 34 條第 20341 條）| 兒童色情：（18 U.S. Code § 2256）
* 威脅/有害評論：（6 U.S. Code § 1508）
* 未經同意共享他人個人信息：（18 U.S. Code § 798）
* 身份盜竊：（俄亥俄州行政代碼 3354:1-20-09）

  

**如果所有這些都被違反**管理員可以禁止/刪除帳戶或_可以在提供正確信息的情況下被用來反對法庭。 示例：圖像/視頻/帖子/回復以及任何可以顯示的內容_可以向聯邦當局顯示的內容。

  

＃＃＃＃ 行政

所有這些規則也適用於您，而不僅僅是您的_客戶_。 您的_Customers_ 可以報告您的帳戶，這將由 [XHiddenProjects](#) 決定。 您的懲罰可以是_刪除帳戶_。 XHiddenProjects 對任何**缺乏兒童保護**或虛假禁令**沒有**和合理解釋的容忍度為 0。

  

#### 報告管理員

在屏幕的一側，將有一個聊天欄顯示在側面。 填寫信息，這將需要以下內容：

1.用戶名
2. 名字和姓氏
3. 禁令日期（將顯示在禁令上屏幕）
4.封禁原因（會在封禁界面顯示）
5. 封禁來源鏈接（管理員提供，請務必索取）

如果您要求鏈接到禁令的來源，管理員**必須**提供，否則將取消判決並解除禁令，因為管理員未能提供證據。
**注意：**在審查時不要篡改_任何_證據，這是可以檢查的，並且可能會受到懲罰。

  

如果您有任何問題，請在 github 上的[討論](https://github.com/XHiddenProjects/WebPress/discussions/2) 中提問。

### 媒體
協作 [Github](https://github.com/XHiddenProjects/WebPress)