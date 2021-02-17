//
//  SitesTableViewCell.m
//  DapiAssessment
//
//  Created by mina wefky on 17/02/2021.
//

#import "SitesTableViewCell.h"

@implementation SitesTableViewCell

- (void)awakeFromNib {
    [super awakeFromNib];
    self.siteUIIameg.hidden = TRUE;
}

- (void)setSelected:(BOOL)selected animated:(BOOL)animated {
    [super setSelected:selected animated:animated];

    // Configure the view for the selected state
}

@end
